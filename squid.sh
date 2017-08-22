#!/bin/bash
php /root/tbody_to_proxy.php
php /root/squid.php
#sudo mv  /etc/squid/squid.conf.bak /etc/squid/squid.conf
#ps -aux | grep "squid" | awk '{prit $2}' | xargs kill -9
sudo service squid restart
