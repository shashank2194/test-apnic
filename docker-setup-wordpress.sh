#!/usr/bin/env bash

wp core install \
    --url="http://localhost:8080" \
    --title="APNIC Foundation News" \
    --admin_user="admin" \
    --admin_password="admin" \
    --admin_email="info@example.com" \
    --skip-email

wp site empty --yes

wp option update blogdescription "APNIC Foundation News"
wp option update timezone_string "Australia/Brisbane"

wp option update permalink_structure "/%year%/%monthnum%/%day%/%postname%/"

wp theme activate apnic-foundation-news
wp plugin activate apnic-foundation-news

HOME_ID=$(
    wp post create \
        --post_type=page \
        --post_title='Home' \
        --post_content='[apnic_foundation_news]' \
        --post_status='publish' \
        --porcelain
)

wp option update page_on_front "${HOME_ID}"
wp option update show_on_front page
