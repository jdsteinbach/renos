# Repository name
set :application,   "renos"
set :domain,        "steinbach.us"

# Load Genesis WordPress' recipe
load File.expand_path(File.dirname(__FILE__)) + '/../bower_components/genesis-wordpress/deployment/deploy.rb'

# Capistrano deployment folder
set :deploy_to,     "/var/www/#{domain}/#{branch}"
