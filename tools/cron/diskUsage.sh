#!/bin/bash
# 
# Example:
# diskUsage.sh sda1 login:password http://my.dashboard/api/module/foobar/data

scriptPath="$( readlink -f "$( dirname "$0" )" )/$( basename "$0" )"
currentDirectory=`dirname $scriptPath`
restClient=$currentDirectory/../restClient.sh
disk=$1
auth=$2
url=$3


diskUsage=`df | grep $disk | awk '{F=NF-1 ; print $F}' | tr -d '%'`

$restClient $auth set $url "$diskUsage"
