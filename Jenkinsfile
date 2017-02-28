parallel(
    "latest" : {
        node('dind') {
        checkout scm
            docker.image('php:latest').inside {
                sh 'apt-get update && apt-get install -y git zip'
                sh 'make build'
                sh 'make test'
            }
        }
    },
    "7.1" : {
        node('dind') {
        checkout scm
            docker.image('php:7.1-cli').inside {
                sh 'apt-get update && apt-get install -y git zip'
                sh 'make build'
                sh 'make test'
            }
        }
    },
    "7.0" : {
        node('dind') {
        checkout scm
            docker.image('php:7.0-cli').inside {
                sh 'apt-get update && apt-get install -y git zip'
                sh 'make build'
                sh 'make test'
            }
        }
    },
    "5.6" : {
        node('dind') {
        checkout scm
            docker.image('php:5.6-cli').inside {
                sh 'apt-get update && apt-get install -y git zip'
                sh 'make build'
                sh 'make test'
            }
        }
    },
    "HHVM" : {
        node('dind') {
        checkout scm
            docker.image('hhvm/hhvm').inside {
                sh 'apt-get update && apt-get install -y git zip'
                sh 'make build'
                sh 'make test'
            }
        }
    }
)

