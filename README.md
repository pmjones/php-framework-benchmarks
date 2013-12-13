This project attempts to benchmark the baseline level of responsiveness of various PHP frameworks to discover the overhead involved in using each one.

The previous version of this project is at Google Code here: <http://code.google.com/p/web-framework-benchmarks/>. This version supersedes the previous version at Google Code.


Benchmarking Server Setup
=========================

Hardware and Operating System
-----------------------------

The benchmark is performed on an Amazon EC2 `m1.large` instance. This provides 4 EC2 compute units and 7.5 G of RAM.  The operating system is a stock 64-bit Ubuntu 13.04 image using instance storage provided via <http://cloud-images.ubuntu.com/releases/13.04/release/>.

Installation instructions for EC2 are beyond the scope of this project. Once you have an EC2 account at Amazon and the appropriate EC2 shell tools, run a new instance under your own username ...

    ec2-run-instances ami-955b79fc --instance-type=m1.large --key={$USERNAME}

... then SSH into the running instance to continue.

    ssh -i /path/to/id_rsa-{$USERNAME} ubuntu@{$SUBDOMAIN}.amazonaws.com


Software Installation
---------------------

After the instance comes online, issue the following shell commands to install and configure the necessary packages.

    # become root
    sudo -s
    
    # initial updates
    aptitude update
    aptitude dist-upgrade -y

    # allow for more socket connections
    ulimit -n 99999

    # apache2, php, git, siege
    aptitude install -y \
        apache2 \
        libapache2-mod-php5 \
        php5 \
        php-apc \
        php5-dev \
        git-all \
        siege

    # install http_load
    cd /root
    wget http://www.acme.com/software/http_load/http_load-12mar2006.tar.gz
    tar -zxvf http_load-12mar2006.tar.gz
    cd http_load-12mar2006
    make
    make install
    
    # modify the Apache DocumentRoot for the project checkout
    cd /etc/apache2/sites-available/
    sed -i "s~/var/www~/var/www/htdocs~" default
    sed -i "s/AllowOverride None/AllowOverride All/" default
    
    # turn off mod_deflate, turn on mod_rewrite
    a2dismod deflate
    a2enmod rewrite
    
    # replace /var/www with the project checkout
    rm -rf /var/www
    git clone git://github.com/pmjones/php-framework-benchmarks.git /var/www
    
    # switch to /var/www and open all permissions (e.g. for caches)
    cd /var/www
    git checkout micro
    chmod -R 777 htdocs
    
    # create real config file from the distribution copy
    cp config.ini-dist config.ini
    
    # restart apache
    service apache2 restart
    
Now you can run the benchmarks against a series of framework targets.


Running the Benchmarks
======================

At the EC2 command line, issue the following:
    
    cd /var/www
    ./bench/http_load target/all.ini

(There are other bench scripts and target files as well.)

The script will do the following for each framework target:

- Restart Apache
- Browse to the framework once to warm up the cache
- Benchmark the the framework 5 times for 1 minute each with 10 users
- Log the results

At the end of the benchmarking, the script will collate the logged benchmark results and print a report on the framework responsiveness.
