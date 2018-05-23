#!/bin/bash
./vendor/bin/test-reporter --stdout > codeclimate.json
curl -X POST -d @codeclimate.json -H 'Content-Type: application/json' -H 'User-Agent: Code Climate (PHP Test Reporter v0.4.4)' https://codeclimate.com/test_reports