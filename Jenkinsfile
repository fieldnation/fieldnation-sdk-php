void setBuildStatus(String message, String state) {
  step([
      $class: "GitHubCommitStatusSetter",
      reposSource: [$class: "ManuallyEnteredRepositorySource", url: "https://github.com/fieldnation/fieldnation-php-sdk"],
      contextSource: [$class: "ManuallyEnteredCommitContextSource", context: "ci/jenkins/build-status"],
      errorHandlers: [[$class: "ChangingBuildStatusErrorHandler", result: "UNSTABLE"]],
      statusResultSource: [ $class: "ConditionalStatusResultSource", results: [[$class: "AnyBuildResult", message: message, state: state]] ]
  ]);
}

parallel(
    "latest" : {
        node('dind') {
            checkout scm
            docker.image('php:latest').inside {
                sh 'apt-get update && apt-get install -y git zip libxml2-dev php-soap > /dev/null'
                sh 'docker-php-ext-install soap > /dev/null'
                sh 'make build'
                sh 'make lint'
                sh 'make test'
            }
            step([$class: 'JUnitResultArchiver', allowEmptyResults: true, testResults: '*.xml'])
            setBuildStatus("Latest complete", "SUCCESS");
        }
    },
    "7.1" : {
        node('dind') {
            checkout scm
            docker.image('php:7.1-cli').inside {
                sh 'apt-get update && apt-get install -y git zip libxml2-dev php-soap > /dev/null'
                sh 'docker-php-ext-install soap > /dev/null'
                sh 'make build'
                sh 'make lint'
                sh 'make test'
            }
            step([$class: 'JUnitResultArchiver', allowEmptyResults: true, testResults: '*.xml'])
            setBuildStatus("7.1 complete", "SUCCESS");
        }
    },
    "7.0" : {
        node('dind') {
            checkout scm
            docker.image('php:7.0-cli').inside {
                sh 'apt-get update && apt-get install -y git zip libxml2-dev php-soap > /dev/null'
                sh 'docker-php-ext-install soap > /dev/null'
                sh 'make build'
                sh 'make lint'
                sh 'make test'
            }
            step([$class: 'JUnitResultArchiver', allowEmptyResults: true, testResults: '*.xml'])
            setBuildStatus("7.0 complete", "SUCCESS");
        }
    },
    "5.6" : {
        node('dind') {
            checkout scm
            docker.image('php:5.6-cli').inside {
                sh 'apt-get update && apt-get install -y git zip libxml2-dev php-soap > /dev/null'
                sh 'docker-php-ext-install soap > /dev/null'
                sh 'make build'
                sh 'make lint'
                sh 'make test'
            }
            step([$class: 'JUnitResultArchiver', allowEmptyResults: true, testResults: '*.xml'])
            setBuildStatus("5.6 complete", "SUCCESS");
        }
    },
    "HHVM" : {
        node('dind') {
            checkout scm
            docker.image('hhvm/hhvm').inside {
                sh 'apt-get update && apt-get install -y git zip make curl > /dev/null'
                sh 'make build'
                sh 'make lint'
                sh 'make test'
            }
            step([$class: 'JUnitResultArchiver', allowEmptyResults: true, testResults: '*.xml'])
            setBuildStatus("HHVM complete", "SUCCESS");
        }
    }
)

