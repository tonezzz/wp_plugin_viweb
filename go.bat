@echo off & cls

::set COMPOSE_CONVERT_WINDOWS_PATHS=1
::set COMPOSE_DOCKER_CLI_BUILD=0
::set DOCKER_BUILDKIT=1
::set BUILDKIT_PROGRESS=plain

set COMPOSE_CONVERT_WINDOWS_PATHS=
set COMPOSE_DOCKER_CLI_BUILD=
set DOCKER_BUILDKIT=
set BUILDKIT_PROGRESS=

rem **********************************************************
rem * go.bat <conf,img,rm,up,pull,push> <service> [v] [d]
rem **********************************************************

@setlocal enableDelayedExpansion

@echo **********************************************************
@set GZ_RUN_PATH=./
@call _init_hot.bat %*
@call _show.bat %*

@set "GZ_BUILD_SERVICE=%~2"
@set "GZ_ACTION=%~1"
@set "GZ_OPTIONS=%~3"
@echo GZ_BUILD_SERVICE=!GZ_BUILD_SERVICE!
@echo GZ_ACTION=!GZ_ACTION!
@echo GZ_OPTIONS=!GZ_OPTIONS!

::@set "IMG_FILES=-f %GZ_BUILD_PATH%docker-image-pythainlp.yaml -f %GZ_DEV_PATH%gzimg-ansible.yaml"
@set "IMG_FILES=-f %GZ_BUILD_PATH%docker-image-pythainlp.yaml"
@set "CON_FILES=-f %GZ_BUILD_PATH%docker-compose.yaml -f %GZ_BUILD_PATH%docker-tools.yaml"
@set "PROXY="
@set "SQUID_IP=172.19.0.2"
::@set "PROXY=--build-arg http_proxy=http://%SQUID_IP%:3128/ --build-arg https_proxy=https://%SQUID_IP%:3128/ "

@IF [!GZ_ACTION!] == [] (@echo Error: go.bat require 2 parameters. & exit /b 1)

rem dir
rem docker compose -f ../psp/docker-compose.yaml -f ../gz_dev/gz-dev.yaml up frontend_dev -d
2>NUL CALL :DO_!GZ_ACTION!
IF ERRORLEVEL 1 CALL :DEFAULT_CASE
GOTO :EXIT

:DEFAULT_CASE
	@echo "Go requires parameters."
	@GOTO END_CASE

:DO_lib
	IF NOT [%~3] == [all] (
		@docker pull ubuntu:20.04
		@docker pull nvidia/cuda:12.2.0-runtime-ubuntu20.04
		@docker pull ubuntu/squid:latest
		@docker pull python:3.8-slim-buster
		::@docker pull keymetrics/pm2:14-alpine
		::@docker pull node:14-alpine
		::@docker pull alpine:3.18
		::@docker pull mailhog/mailhog:v1.0.1
		::@docker pull registry:2
		::@docker pull apimastery/apisimulator
		::@docker pull corbanr/ansible:2.9-ubuntu20.04
		::@docker pull mariadb:10.7-focal
	)
	@docker pull mongo:5.0-focal
	@GOTO END_CASE

:DO_imgconf
rem @IF [!GZ_ACTION!] == [conf] (
	@echo "***** Config check (service=%GZ_BUILD_SERVICE%)"
	@set cmd=docker compose --env-file go.env %IMG_FILES% config %GZ_BUILD_SERVICE%
	GOTO END_CASE

:DO_img
	@echo "### Building (service=%GZ_BUILD_SERVICE%:%GZ_BUILD_VERSION%-%GZ_BUILD_HOST%)"
	IF [!GZ_OPTIONS!] == [rm] (
		docker container stop %GZ_CONTAINER_NAME%
		docker container rm %GZ_CONTAINER_NAME%
		docker rmi %GZ_IMAGE_NAME%
	)
	@set "cmd=docker compose --env-file go.env %IMG_FILES% build %PROXY% %GZ_BUILD_SERVICE%"
	GOTO END_CASE

:DO_conf
	@echo "***** Config check (service=%GZ_BUILD_SERVICE%)"
	@set "cmd=docker compose --env-file go.env %CON_FILES% config %GZ_BUILD_SERVICE%"
	GOTO END_CASE

:DO_up
	IF [!GZ_OPTIONS!] == [rm] (
		docker container stop %GZ_CONTAINER_NAME%
		docker container rm %GZ_CONTAINER_NAME%
		docker rmi %GZ_IMAGE_NAME%
	)
	@echo "***** container start (service=%GZ_BUILD_SERVICE%)"
	@set "cmd=docker compose --env-file go.env %CON_FILES% up %GZ_BUILD_SERVICE% -d"
	GOTO END_CASE

:DO_pull
	@echo GZ_IMG_VERSION=%GZ_BUILD_VERSION%
	@set GZ_IMG_NAME_TAG=%GZ_BUILD_NAME%/%GZ_BUILD_SERVICE%:%GZ_BUILD_VERSION%-%GZ_BUILD_NAME%
	IF [%~3] == [d] (
		@set GZ_IMG_NAME_TAG=!GZ_IMG_NAME_TAG!-%GZ_BUILD_NAME%
	)
	@echo ... Pulling [image=!GZ_IMG_NAME_TAG!]
	@set cmd=docker pull !GZ_DOCKER_REGISTRY!!GZ_IMG_NAME_TAG!
	GOTO END_CASE

:DO_push
	@echo GZ_IMG_VERSION=%GZ_BUILD_VERSION%
	@set GZ_IMG_NAME_TAG=%GZ_BUILD_NAME%/%GZ_BUILD_SERVICE%:%GZ_BUILD_VERSION%-%GZ_BUILD_NAME%
	IF [%~3] == [d] (
		@set GZ_IMG_NAME_TAG=!GZ_IMG_NAME_TAG!-%GZ_BUILD_NAME%
	)
	@echo ... Registering [image=!GZ_IMG_NAME_TAG!]
	@set cmd=docker push !GZ_DOCKER_REGISTRY!!GZ_IMG_NAME_TAG!
	GOTO END_CASE
)

:END_CASE
	@echo !cmd!
	@!cmd!

	VER > NUL #Reset ERRORLEVEL
	GOTO :EOF #return from CALL

:EXIT
	endlocal
	docker image prune --force
