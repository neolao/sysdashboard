#!/bin/bash

checkCurl=$(which curl)
if [ "$checkCurl" = "" ]
then
    "cURL not found"
    exit;
fi

usage() {
cat <<USAGE

SYSDASHBOARD REST CLIENT
‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾
┌——————————————————┬————————————————————————————————————————————————————————————————————————————————————————————┐
│ Usage            │ restClient.sh auth method url [data]                                                       │
├——————————————————┼————————————————————————————————————————————————————————————————————————————————————————————┤
│ Example get data │ restClient.sh netrc get http://my.website/sysdashboard/api/module/myPie/data               │
├——————————————————┼————————————————————————————————————————————————————————————————————————————————————————————┤
│ Example set data │ restClient.sh login:password set http://my.website/sysdashboard/api/module/myPie/data "42" │
└——————————————————┴————————————————————————————————————————————————————————————————————————————————————————————┘
USAGE
}

auth=$1
method=$2
url=$3
data=$4

if [ "$auth" == "netrc" ]
then
    option="-n"
else
    option="--user $auth"
fi


if [ "$method" == "get" ]
then
    curl -X GET $option $url
    echo
    exit;
fi

if [ "$method" == "set" ]
then
    curl -X PUT $option --data $data $url
    echo
    exit;
fi

usage
