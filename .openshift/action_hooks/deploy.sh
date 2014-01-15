#!/bin/bash
# .openshift/action_hooks/deploy
( unset GIT_DIR ; cd $OPENSHIFT_REPO_DIR ; /usr/local/zend/bin/php composer.phar install )