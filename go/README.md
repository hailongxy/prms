# 使用说明

go的版本需要大于或等于1.23.0

## Docker相关

### 导入麒麟Go基础镜像：
```aiignore
docker load -i /Users/hailongxy/Documents/projects/docker/GolangKylinForArm64/golang-kylin-arm64-latest.tar
```

### 构建镜像：
```aiignore
docker build -t prms-go .
```

### 运行镜像：
```aiignore
docker run -it --rm --name prms-go prms-go
```

### 导出镜像：
```aiignore
docker save -o prms-go-latest.tar prms-go
```

### 打包镜像：
```aiignore
./pack.sh
```

### 进入容器shell
```aiignore
kubectl exec -it prms-go-6d4bbb4d5f-v2x6v -- bash
```