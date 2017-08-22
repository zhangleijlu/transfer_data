#!/bin/bash
ps -aux | grep "pyspider" |awk '{print $2}' |xargs kill -9
nohup pyspider &

