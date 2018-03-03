#!/bin/sh

if [ "$1" = "travis" ]
then
    psql -U postgres -c "CREATE DATABASE artika_test;"
    psql -U postgres -c "CREATE USER artika PASSWORD 'artika' SUPERUSER;"
else
    [ "$1" != "test" ] && sudo -u postgres dropdb --if-exists artika
    [ "$1" != "test" ] && sudo -u postgres dropdb --if-exists artika_test
    [ "$1" != "test" ] && sudo -u postgres dropuser --if-exists artika
    sudo -u postgres psql -c "CREATE USER artika PASSWORD 'artika' SUPERUSER;"
    [ "$1" != "test" ] && sudo -u postgres createdb -O artika artika
    sudo -u postgres createdb -O artika artika_test
    LINE="localhost:5432:*:artika:artika"
    FILE=~/.pgpass
    if [ ! -f $FILE ]
    then
        touch $FILE
        chmod 600 $FILE
    fi
    if ! grep -qsF "$LINE" $FILE
    then
        echo "$LINE" >> $FILE
    fi
fi
