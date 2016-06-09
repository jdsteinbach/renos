Vagrant.configure("2") do |config|
  # Configuring the hostmanager to automatically alter the hosts file for development testing
  config.hostmanager.enabled            = true
  config.hostmanager.include_offline    = true
  config.hostmanager.ignore_private_ip  = false
  config.hostmanager.manage_host        = true

  # Every Vagrant virtual environment requires a box to build off of.
  config.vm.box         = "precise64"
  config.vm.box_url     = "http://files.vagrantup.com/precise64.box"
  config.ssh.insert_key = false

  # Configure 1GB (1024MB) of memory
  config.vm.provider :virtualbox do |vb|
    vb.customize ["modifyvm", :id, "--memory", 1024]
    vb.customize ["modifyvm", :id, "--natdnshostresolver1", "on"]
  end

  config.vm.define :local do |box|
    box.vm.hostname = "local.steinbach.us"

    # Static IP for testing.
    box.vm.network :private_network, ip: "192.168.31.93"
    box.vm.network :forwarded_port, guest: 22, host: 3193, auto_correct: true

    box.ssh.forward_agent = true

    # Remount the default shared folder as NFS for caching and speed
    box.vm.synced_folder ".", "/vagrant", :nfs => true

    # Mount local SSH keys for deployments
    box.vm.synced_folder "~/.ssh", "/home/vagrant/.ssh"

    # Provision local.steinbach.us
    box.vm.provision :shell do |shell|
      shell.inline = "/vagrant/bin/provision"
    end
  end

  # Update IPs
  config.vm.provision :hostmanager
end
