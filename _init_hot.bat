@echo off

rem **********************************************************
rem * _init_hot.bat - Gen ENV for building, also gen _show.bat
rem * go.sh <up/pull> <img_name> [v] [d]
rem **********************************************************

set GZ_INITED=1
set GZ_BUILD_SERVICE=%~2
set z0=
set z1=
set z2=

rem set GZ_RUN_PATH=../gpt/
set INPUT_ENV_FILE=%GZ_RUN_PATH%go.env
set OUTPUT_SHOW_BAT=%GZ_RUN_PATH%_show.bat
set OUTPUT_SHOW_SH=%GZ_RUN_PATH%_show.sh
set OUTPUT_INIT_BAT=%GZ_RUN_PATH%_init.bat
set OUTPUT_INIT_SH=%GZ_RUN_PATH%_init.sh

echo @echo off > %OUTPUT_INIT_BAT%
echo # > %OUTPUT_INIT_SH%
echo @echo off > %OUTPUT_SHOW_BAT%
echo # > %OUTPUT_SHOW_SH%

for /F "delims== tokens=1,2 eol=#" %%i in (%INPUT_ENV_FILE%) do (
	set z0=%%i
	set z1=%%j
	@IF [!z1!] == [${1}] (
		set z2=^%%^~1
	) else (
		set z2=!z1:$=!
		set z2=!z2:{=%%!
		set z2=!z2:}=%%!
	)
	call set %%i=!z2!
	echo set %%i=!z2!>>!OUTPUT_INIT_BAT!
	echo export %%i=!z1!>>!OUTPUT_INIT_SH!
	echo echo %%i=%%%%i%%>>!OUTPUT_SHOW_BAT!
	echo echo %%i=${%%i}>>!OUTPUT_SHOW_SH!
)
rem echo *****


