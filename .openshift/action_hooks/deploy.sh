#!/bin/bash
# .openshift/action_hooks/deploy
export COMPOSER_HOME="$OPENSHIFT_DATA_DIR/.composer"
if [ ! -f "$OPENSHIFT_DATA_DIR/composer.phar" ]; then
    curl -s https://getcomposer.org/installer | /usr/bin/php -- --install-dir=$OPENSHIFT_DATA_DIR
else
	/usr/bin/php $OPENSHIFT_DATA_DIR/composer.phar self-update
fi
( unset GIT_DIR ; cd $OPENSHIFT_REPO_DIR ; /usr/bin/php $OPENSHIFT_DATA_DIR/composer.phar install )