#!/usr/bin/env bash
#Change ownership to appropriate user:group
chown -R ${GLOBAL_OWNER}:${GLOBAL_GROUP} ${GLOBAL_TARGETROOT}/wp-content/themes
chown -R ${GLOBAL_OWNER}:${GLOBAL_GROUP} ${GLOBAL_TARGETROOT}/wp-content/plugins

#Change permissions to proper permissions
chmod -R 755 ${GLOBAL_TARGETROOT}/wp-content/themes
chmod -R 755 ${GLOBAL_TARGETROOT}/wp-content/plugins

# Package up the site build for deployment to clients server
# Once you run this command you can than download the zip file
#
# cd ${GLOBAL_TARGETROOT} && wp db dump ${NAME}.sql
# tar -czf ${GLOBAL_TARGETROOT}/${NAME}.tar.gz ${GLOBAL_TARGETROOT}