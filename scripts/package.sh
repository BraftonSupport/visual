#!/usr/bin/env bash

#db dump
cd $PATH && wp db dump $NAME.sql

#zip up files
tar -czf /var/www/html/design/brafton/backups/$PATH $NAME.tar.gz