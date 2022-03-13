# APNIC Foundation News

Centralized location for presenting news about the goings on of APNIC Foundation.

-   [Getting Started](#getting-started)
-   [Troubleshooting](#troubleshooting)

## Getting Started

### Prepare

-   Ensure that you have [Docker](https://www.docker.com/products/docker-desktop) installed and running.
-   Ensure that you have `make` installed, on macOS or Linux, this should already be installed, if your running Windows,
    see [this Stackoverflow post](https://stackoverflow.com/questions/32127524).

### Build and Run

```shell
make local
```

### Visit

You can now access the site running on [http://localhost:8080](http://localhost:8080).

### Hot Reload (optional)

While developing the SPA, you will likely want immediate feedback. This can be achieved by running the HMR version of
ReactJS with the following command:

```shell
npm install && npm run start
```

Once the initial build is complete, the SPA will automatically open in your browser.

### IDE Support (optional)

You might want to get support for WordPress in your IDE, this might require a local copy of WordPress to be downloaded.
A script is available to assist with this:

```shell
make help_ide
```

## Troubleshooting

### Cannot get make to work

You can run the commands directly instead of via make, use the following instead to start local environment:

```shell
docker compose down --volumes --rmi local \
    && docker compose up --detach \
    && sleep 20 \
    && docker exec -it --user www-data "apnic_foundation_news_web" /app/docker-setup-wordpress.sh \
    && echo "visit http://localhost:8080"
```

### Local environment won't start

-   Check docker is running
-   Check that you don't have any other servers running on the `8080` port


### Challanges that I faced.

- It was bit challenging for setup docker for me in starting but after few tutorials I completed that and did all my tasks.

- For implemention of Lazy loading I require to fetch the RSS data in chunks so that on each scroll next data is requested from server after some reserach and code trials through JS but it didin't give the desired results.

- I added PHP unit test and PHP environment but I am stuck at PHP framework TestCase base class not foundwhen I run the existing 3 test case already defined in this project.
