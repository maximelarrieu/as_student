const redis = require('redis');
const port = 6379
const client = redis.createClient(port);

module.exports = client;