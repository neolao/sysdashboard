var packageSettings = require(__dirname + "/../package");

module.exports = {
    "sysdashboard":
    {
    },

    "console":
    {
        "title": "SysDashboard " + packageSettings.version
    },

    "server": {
        "port": 1337,
        "middlewares": [
            "@static.middleware"
        ]
    },

    "static": {
        "directories": [
            __dirname + "/../web"
        ]
    }


};
