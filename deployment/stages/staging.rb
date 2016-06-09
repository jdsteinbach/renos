role :db,           "staging.steinbach.us"
role :web,          "staging.steinbach.us"

set :stage,         "staging"

# Open site after deploying
after "deploy" do
    system "open http://#{branch}.#{stage}.#{domain}/"
end
