module.exports = {
  resolve: {
    fallback: {
      http: require.resolve("stream-http"),
      url: require.resolve("url/"),
      path: require.resolve("path/"),
      stream: require.resolve("stream-browserify"),
      buffer: require.resolve("buffer/"),
    },
  },
};
