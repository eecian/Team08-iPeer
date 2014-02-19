include ipeer::web
include ipeer::db
include git

ipeer::instance { ipeerdev :
    server_domain => "localhost",
    doc_base => "/var/www",
    db_host => $fqdn,
    port => 2000
}

# create ipeer_test database for tests
if ! defined(Mysql::Db["ipeer_test"]) {
    @@mysql::db { "ipeer_test":
        user => $db_username,
        password => $db_password,
        host => "ipeer_test" ? {
  	    'localhost' => "ipeer_test",
        default => $fqdn,
    },
        grant => ['ALL'],
    }
}

file { "/etc/nginx/conf.d/default.conf" :
    ensure => absent,
    notify => Service["nginx"]
}