parallel(
    "7.1" : {
        node('dind') {
	    checkout scm
            docker.image('php:7.1.2-cli').inside {
		sh 'apt-get update && apt-get install -y git'
		sh 'make build'
		sh 'make test'
            }
        }
    },
    "7.0" : {
        node('dind') {
	    checkout scm
            docker.image('php:7.0.16-cli').inside {
		sh 'apt-get update && apt-get install -y git'
                sh 'make build'
		sh 'make test'
		}
        }
    },
    "5.6" : {
        node('dind') {
	    checkout scm
            docker.image('php:5.6.30-cli').inside {
		sh 'apt-get update && apt-get install -y git'
            	sh 'make build'
		sh 'make test'
            }
        }
    }
)

