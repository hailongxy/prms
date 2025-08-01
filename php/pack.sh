#!/bin/bash

docker load -i /Users/hailongxy/Documents/projects/docker/PHPKylinForArm64/php-kylin-arm64-latest.tar

docker build -t prms-php .

kubectl apply -f Deployment.yaml

kubectl rollout restart deployment prms-php