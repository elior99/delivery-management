module.exports = {
  configureWebpack: {
    optimization: {
      splitChunks: false,
    },
  },
  filenameHashing: false,
  pages: {
    build: {
      entry: "src/main.js",
      filename: "index.html",
    },
  },

  devServer: {
    proxy: {
      "/arci": {
        target: "http://localhost",
        changeOrigin: true,
        logLevel: "debug",
        pathRewrite: { "/arci": "http://localhost/vue/arci" },
      },
    },
  },
  lintOnSave: false,
};

