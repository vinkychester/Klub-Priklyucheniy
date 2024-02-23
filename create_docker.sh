#!/bin/sh

GREEN='\033[0;32m'
NC='\033[0m'

echo ""
echo "${GREEN}STARTING ALL LOCAL CONTAINERS${NC}"
echo ""

# Starting local containers
docker compose -f docker-compose.yml up --build

echo ""
echo "${GREEN}FINISHED!${NC}"