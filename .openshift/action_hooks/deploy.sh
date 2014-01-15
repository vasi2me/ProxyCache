#!/bin/bash
# .openshift/action_hooks/deploy
unset GIT_DIR
cd $OPENSHIFT_REPO_DIR
curl -sS https://getcomposer.org/installer | php
php composer.phar install --prefer-source --no-interaction  // the arguments is used to work around github api rate limits
php composer.phar dump-autoload