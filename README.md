# 工具库

## 目录结构
.
├── autoload.php       // 自动加载命名空间
├── composer.json      // composer的属性文件
├── composer.phar*     // composer的可执行文件
├── example/           // 示例文件
│   ├── angle.php*
│   ├── line.php*
│   ├── point.php*
│   └── triangle.php*
├── LICENSE            // 许可证书
├── README.md          // 自述文件
├── src/               // 项目源码
│   └── Leo/           // Leo命名空间
│       ├── Base.php*
│       ├── Exception.php*
│       ├── Figure/
│       ├── File.php*
│       ├── Geo.php*
│       └── Net.php*
└── test/              // 测试套件
    ├── bootstrap.php* // 测试套件的引导文件
    └── Leo/
        ├── BaseTest.php*
        └── Figure/
