FROM mediawiki:1.39.5-fpm

# Use bash for all RUN commands instead of sh (for `echo -e`)
SHELL ["/bin/bash", "-c"]

# Avoid annoying debian prompts (fedora ftw)
ENV DEBIAN_FRONTEND=noninteractive

# Create script directory
RUN mkdir /wiki/

# Apply custom patches
#COPY ./patches/ /var/www/html/patches/
#RUN for i in /var/www/html/patches/*.patch; do patch -p1 < $i; done

# Copy extensions to the image
COPY ./extensions/ /var/www/html/extensions/

# Copy skins to the image
COPY ./skins/ /var/www/html/skins/

# Copy custom LocalSettings.php
COPY ./conf/LocalSettings.php /var/www/html/LocalSettings.php

# Composer
RUN apt-get update && \
    apt-get install zip unzip
COPY --from=composer:latest /usr/bin/composer /usr/local/bin/composer

# Semantic Mediawiki
COPY ./conf/composer.local.json /var/www/html/composer.local.json
RUN chown -R root ./composer.json && \
    /usr/local/bin/composer config --no-plugins allow-plugins.wikimedia/composer-merge-plugin && \
    /usr/local/bin/composer update --no-dev

# NGINX
RUN apt-get update && \
    apt-get -y install curl gnupg2 ca-certificates lsb-release debian-archive-keyring lsb-release && \
    curl https://nginx.org/keys/nginx_signing.key | gpg --dearmor | tee /usr/share/keyrings/nginx-archive-keyring.gpg >/dev/null && \
    gpg --dry-run --quiet --no-keyring --import --import-options import-show /usr/share/keyrings/nginx-archive-keyring.gpg | grep -q '573BFD6B3D8FBC641079A6ABABF5BD827BD9BF62' && \
    echo -e "deb [signed-by=/usr/share/keyrings/nginx-archive-keyring.gpg] http://nginx.org/packages/debian `lsb_release -cs` nginx" | tee /etc/apt/sources.list.d/nginx.list && \
    echo -e "Package: *\nPin: origin nginx.org\nPin: release o=nginx\nPin-Priority: 900\n" | tee /etc/apt/preferences.d/99nginx && \
    apt-get update && \
    apt-get install -y nginx

# Custom NGINX configuration
COPY ./conf/nginx.conf /etc/nginx/sites-enabled/default

# Supervisor daemon
RUN apt-get update && \
    apt-get install -y supervisor --no-install-recommends

COPY ./conf/supervisord.conf /etc/supervisor/conf.d/

# Cron
RUN apt-get install -y cron --no-install-recommends

RUN mkdir /wiki/cron

# Add cron files
ADD cron/update_spamlist.sh /wiki/cron/update_spamlist.sh
ADD cron/run_jobs.sh /wiki/cron/run_jobs.sh
# Update permissions
RUN chmod 0544 /wiki/cron/update_spamlist.sh

# Update crontab
RUN echo "0 0 * * * root bash /wiki/cron/update_spamlist.sh" >> /etc/crontab && \
    echo "0 * * * * root bash /wiki/cron/run_jobs.sh" >> /etc/crontab

# Imagemagick
RUN apt-get install -y imagemagick --no-install-recommends

# Image directory
RUN chmod 766 /var/www/html/images

# Custom entrypoint
COPY entrypoint.sh /etc/entrypoint.sh
ENTRYPOINT ["/etc/entrypoint.sh"]
