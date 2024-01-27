# wp_plugin_viweb
[Test dev env 1 ](https://open.docker.com/dashboard/dev-envs?url=https://github.com/tonezzzzz/wp_plugin_viweb/blob/init-docker-grafana/devenv_test.yml)


# Grarana container to be added?
  grafana:
    image: ${COMPOSE_PROJECT_NAME}_grafana/grafana-enterprise
    container_name: grafana
    restart: ${RESTART_POLICY}
    environment:
      - GCLOUD_HOSTED_METRICS_URL=
    ports:
      - '3000:3000'
    volumes:
      - ./dockers/storage/grafana-data:/var/lib/grafana