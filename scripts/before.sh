#!/usr/bin/env bash
NEWSITE=0
#create wp if not already there
if [ ! -d "${GLOBAL_TARGETROOT}" ]
then
    wp core download --path=${GLOBAL_TARGETROOT} --allow-root
    cd ${GLOBAL_TARGETROOT} && wp core config --dbprefix=${NAME}_ --allow-root
    cd ${GLOBAL_TARGETROOT} && wp core install --url=${GLOBAL_URL} --title="${GLOBAL_TITLE}" --allow-root
    chown -R ${GLOBAL_OWNER}:${GLOBAL_GROUP} ${GLOBAL_TARGETROOT}
    chmod -R 755 ${GLOBAL_TARGETROOT}
    NEWSITE=1
fi
#To deploy plugins uncomment the below lines
#
#cp -R $HERMES_ROOT/plugins/* ${GLOBAL_TARGETROOT}/wp-content/plugins

#If new installation update plugins
if [[ $NEWSITE = 1 ]]
then
    cd ${GLOBAL_TARGETROOT} && wp plugin update --all --allow-root
fi

#If your theme requires a parent theme comment out the following
#
#cp $HERMES_ROOT/themes/{themeName} ${GLOBAL_TARGETROOT}/wp-content/{themeName}
