const path = require("path");

module.exports = {
    paths: function (paths, env) {
        paths.appIndexJs = path.resolve(__dirname, "src/ts/index.tsx");
        paths.appSrc = path.resolve(__dirname, "src/ts");
        paths.appPublic = path.resolve(__dirname, "src/public");
        paths.appHtml = path.resolve(__dirname, "src/public/index.html");
        return paths;
    },
};
