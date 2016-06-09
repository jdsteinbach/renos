role :db,           "production.steinbach.us"
role :web,          "production.steinbach.us"

set :stage,         "production"
set :branch,        "master"
set :deploy_to,     "/var/www/#{domain}/master"

# Open site after deploying
after "deploy" do
    system "open http://#{stage}.#{domain}/"
end
