#!/bin/bash

sleep 1s
forever stopall
sleep 1s

ps -ef | grep gohttpserver | grep -v grep | cut -c 9-15 | xargs kill -s 9
ps -ef | grep sails | grep -v grep | cut -c 9-15 | xargs kill -s 9
sleep 2s
