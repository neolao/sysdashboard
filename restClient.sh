#!/bin/bash

usage() {
cat <<USAGE

SYSDASHBOARD REST CLIENT
‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾
┌——————————————————┬—————————————————————————————————————————————————————————————————————————————————————┐
│ Usage            │ restClient.sh login method url [data]                                               │
├——————————————————┼—————————————————————————————————————————————————————————————————————————————————————┤
│ Example get data │ restClient.sh myLogin get http://my.website/sysdashboard/api/module/myPie/data      │
├——————————————————┼—————————————————————————————————————————————————————————————————————————————————————┤
│ Example set data │ restClient.sh myLogin set http://my.website/sysdashboard/api/module/myPie/data "42" │
└——————————————————┴—————————————————————————————————————————————————————————————————————————————————————┘
USAGE
}

login=$1
method=$2
url=$3
data=$4

if [ "$method" == "get" ]
then
    curl -X GET --user $login $url
    echo
    exit;
fi

if [ "$method" == "set" ]
then
    curl -X PUT --user $login --data $data $url
    echo
    exit;
fi

usage
