#!/bin/bash
rsync --compress-level=9 --exclude '*.psd' --exclude '.git' -a --progress ./  root@vps.mupi.com.sv:/var/www/facejobs.org/
