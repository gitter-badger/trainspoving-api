set :application, "trainspoving"
set :domain,      "#{application}.mathieudarse.fr"
set :deploy_to,   "/var/www/#{domain}"
set :app_path,    "app"

set :repository,  "git@github.com:mdarse/trainspoving-api.git"
set :scm,         :git
# Or: `accurev`, `bzr`, `cvs`, `darcs`, `subversion`, `mercurial`, `perforce`, or `none`
set :deploy_via, :remote_cache

set :use_composer,    true
# set :update_vendors,  true
set :copy_vendors,    false
set :cache_warmup,    false
set :shared_files,    ["app/config/parameters.yml"]
# set :writable_dirs,       [app_path + "/cache", app_path + "/logs"]
# set :webserver_user,      "www-data"
set :permission_method,   :acl
set :use_set_permissions, true

set :model_manager, "doctrine"
# Or: `propel`

role :web,        domain                         # Your HTTP server, Apache/etc
role :app,        domain, :primary => true       # This may be the same as your `Web` server
role :db,         domain, :primary => true       # This is where Symfony2 migrations will run

ssh_options[:port] = 11722
set :user,          "root"
set :use_sudo,      false
set :keep_releases, 3

# Be more verbose by uncommenting the following line
# logger.level = Logger::MAX_LEVEL

task :upload_parameters do
  origin_file = "app/config/parameters_prod.yml"
  destination_file = shared_path + "/app/config/parameters.yml" # Notice the shared_path

  try_sudo "mkdir -p #{File.dirname(destination_file)}"
  top.upload(origin_file, destination_file)
end

after "deploy:setup", "upload_parameters"
