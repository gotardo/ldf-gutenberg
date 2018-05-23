#!/bin/bash
./vendor/bin/phpmetrics --report-html=reporting/phpmetrics .
./vendor/bin/phpunit -c phpunit.xml.dist