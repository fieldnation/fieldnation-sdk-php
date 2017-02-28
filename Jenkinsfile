parallel(
    "latest" : {
        node('dind') {
            checkout scm
            docker.image('php:latest').inside {
                sh 'apt-get update && apt-get install -y git zip > /dev/null'
                sh 'make build'
                sh 'make lint'
                sh 'make test'
            }
            step([$class: 'JUnitResultArchiver', allowEmptyResults: true, testResults: '*.xml'])
        }
    },
    "7.1" : {
        node('dind') {
            checkout scm
            docker.image('php:7.1-cli').inside {
                sh 'apt-get update && apt-get install -y git zip > /dev/null'
                sh 'make build'
                sh 'make lint'
                sh 'make test'
            }
            step([$class: 'JUnitResultArchiver', allowEmptyResults: true, testResults: '*.xml'])
        }
    },
    "7.0" : {
        node('dind') {
            checkout scm
            docker.image('php:7.0-cli').inside {
                sh 'apt-get update && apt-get install -y git zip > /dev/null'
                sh 'make build'
                sh 'make lint'
                sh 'make test'
            }
            step([$class: 'JUnitResultArchiver', allowEmptyResults: true, testResults: '*.xml'])
        }
    },
    "5.6" : {
        node('dind') {
            checkout scm
            docker.image('php:5.6-cli').inside {
                sh 'apt-get update && apt-get install -y git zip > /dev/null'
                sh 'make build'
                sh 'make lint'
                sh 'make test'
            }
            step([$class: 'JUnitResultArchiver', allowEmptyResults: true, testResults: '*.xml'])
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
        }
    }
)
