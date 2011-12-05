#!/bin/bash
rsync --compress --exclude '*.psd' --exclude '.git' -av ./  root@vps.mupi.com.sv:/var/www/facejobs.org/
