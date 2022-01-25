#!/bin/bash
echo 'starting csns'
/usr/bin/chirpstack-network-server &
service apache2 restart
sleep infinity