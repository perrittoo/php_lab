#!/bin/sh

mv /flag.txt /flag$(cat /dev/urandom | tr -cd '0-9' | head -c 4).txt
chmod 444 /flag*.txt



