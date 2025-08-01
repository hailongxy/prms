# 使用说明

php的版本为php8

## Docker相关

### 导入麒麟PHP基础镜像：
```aiignore
docker load -i /Users/hailongxy/Documents/projects/docker/PHPKylinForArm64/php-kylin-arm64-latest.tar
```

### 构建镜像：
```aiignore
docker build -t prms-php .
```

### 导出镜像：
```aiignore
docker save -o prms-php-latest.tar prms-php
```

### 部署镜像：
```aiignore
./pack.sh
```

### 进入容器shell
```aiignore
kubectl exec -it prms-php-5f74dc9564-cfd7x -- bash
```