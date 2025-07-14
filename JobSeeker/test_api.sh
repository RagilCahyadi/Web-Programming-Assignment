#!/bin/bash

BASE_URL="http://127.0.0.1:8000/api/v1"

echo "=========================================="
echo "API Testing Script for Job Seekers"
echo "=========================================="

# Colors for output
RED='\033[0;31m'
GREEN='\033[0;32m'
YELLOW='\033[1;33m'
NC='\033[0m' # No Color

print_test() {
    echo -e "${YELLOW}Testing: $1${NC}"
}

print_success() {
    echo -e "${GREEN}✓ $1${NC}"
}

print_error() {
    echo -e "${RED}✗ $1${NC}"
}

# Test A1a - Login success
print_test "A1a - Login success"
LOGIN_RESPONSE=$(curl -s -X POST "$BASE_URL/auth/login" \
  -F "id_card_number=20210001" \
  -F "password=121212")

if echo "$LOGIN_RESPONSE" | grep -q "token"; then
    print_success "Login successful"
    TOKEN=$(echo "$LOGIN_RESPONSE" | jq -r '.token' 2>/dev/null)
    echo "Token: $TOKEN"
else
    print_error "Login failed"
    echo "Response: $LOGIN_RESPONSE"
    exit 1
fi

echo

# Test A1b - Login failed
print_test "A1b - Login with wrong password"
WRONG_LOGIN=$(curl -s -X POST "$BASE_URL/auth/login" \
  -F "id_card_number=20210001" \
  -F "password=wrongpass")

if echo "$WRONG_LOGIN" | grep -q "incorrect"; then
    print_success "Wrong login correctly rejected"
else
    print_error "Wrong login should be rejected"
    echo "Response: $WRONG_LOGIN"
fi

echo

# Test A1c - Logout success
print_test "A1c - Logout success"
LOGOUT_RESPONSE=$(curl -s -X POST "$BASE_URL/auth/logout?token=$TOKEN")

if echo "$LOGOUT_RESPONSE" | grep -q "success"; then
    print_success "Logout successful"
else
    print_error "Logout failed"
    echo "Response: $LOGOUT_RESPONSE"
fi

echo

# Test A1d - Logout with invalid token
print_test "A1d - Logout with invalid token"
BAD_LOGOUT=$(curl -s -X POST "$BASE_URL/auth/logout?token=invalid")

if echo "$BAD_LOGOUT" | grep -q "Invalid token"; then
    print_success "Invalid token correctly rejected"
else
    print_error "Invalid token should be rejected"
    echo "Response: $BAD_LOGOUT"
fi

echo

# Get new token for further tests
print_test "Getting new token for further tests"
LOGIN_RESPONSE=$(curl -s -X POST "$BASE_URL/auth/login" \
  -F "id_card_number=20210001" \
  -F "password=121212")
TOKEN=$(echo "$LOGIN_RESPONSE" | jq -r '.token' 2>/dev/null)
echo "New token: $TOKEN"

echo

# Test A2a - Request validation success
print_test "A2a - Request validation success"
VALIDATION_RESPONSE=$(curl -s -X POST "$BASE_URL/validation?token=$TOKEN" \
  -F "work_experience=5 years experience" \
  -F "job_category_id=1" \
  -F "job_position=Senior Developer" \
  -F "reason_accepted=Experienced in web development")

echo "Validation response: $VALIDATION_RESPONSE"

echo

# Test A2b - Request validation invalid token
print_test "A2b - Request validation with invalid token"
BAD_VALIDATION=$(curl -s -X POST "$BASE_URL/validation?token=invalid" \
  -F "work_experience=5 years experience" \
  -F "job_category_id=1" \
  -F "job_position=Senior Developer" \
  -F "reason_accepted=Experienced in web development")

echo "Bad validation response: $BAD_VALIDATION"

echo

# Test A2c - Get validation success
print_test "A2c - Get validation success"
GET_VALIDATION=$(curl -s -X GET "$BASE_URL/validations?token=$TOKEN")
echo "Get validation response: $GET_VALIDATION"

echo

# Test A2d - Get validation invalid token
print_test "A2d - Get validation with invalid token"
BAD_GET_VALIDATION=$(curl -s -X GET "$BASE_URL/validations?token=invalid")
echo "Bad get validation response: $BAD_GET_VALIDATION"

echo

# Test A3a - Get all job vacancies success
print_test "A3a - Get all job vacancies success"
JOB_VACANCIES=$(curl -s -X GET "$BASE_URL/job_vacancies?token=$TOKEN")
echo "Job vacancies response: $JOB_VACANCIES"

echo

# Test A3b - Get all job vacancies invalid token
print_test "A3b - Get all job vacancies with invalid token"
BAD_JOB_VACANCIES=$(curl -s -X GET "$BASE_URL/job_vacancies?token=invalid")
echo "Bad job vacancies response: $BAD_JOB_VACANCIES"

echo

# Test A3c - Get detail job vacancy success
print_test "A3c - Get detail job vacancy success"
JOB_VACANCY_DETAIL=$(curl -s -X GET "$BASE_URL/job_vacancies/1?token=$TOKEN")
echo "Job vacancy detail response: $JOB_VACANCY_DETAIL"

echo

# Test A3d - Get detail job vacancy invalid token
print_test "A3d - Get detail job vacancy with invalid token"
BAD_JOB_VACANCY_DETAIL=$(curl -s -X GET "$BASE_URL/job_vacancies/1?token=invalid")
echo "Bad job vacancy detail response: $BAD_JOB_VACANCY_DETAIL"

echo

# Test A4a - Applying for jobs success
print_test "A4a - Applying for jobs success"
APPLICATION_RESPONSE=$(curl -s -X POST "$BASE_URL/applications?token=$TOKEN" \
  -F "vacancy_id=1" \
  -F "positions[]=1" \
  -F "positions[]=2" \
  -F "notes=I am interested in this position and believe I would be a great fit")

echo "Application response: $APPLICATION_RESPONSE"

echo

# Test A4b - Applying for jobs invalid token
print_test "A4b - Applying for jobs with invalid token"
BAD_APPLICATION=$(curl -s -X POST "$BASE_URL/applications?token=invalid" \
  -F "vacancy_id=1" \
  -F "positions[]=1" \
  -F "positions[]=2" \
  -F "notes=I am interested in this position and believe I would be a great fit")

echo "Bad application response: $BAD_APPLICATION"

echo

# Test A4f - Get all job applications success
print_test "A4f - Get all job applications success"
GET_APPLICATIONS=$(curl -s -X GET "$BASE_URL/applications?token=$TOKEN")
echo "Get applications response: $GET_APPLICATIONS"

echo

# Test A4g - Get all job applications invalid token
print_test "A4g - Get all job applications with invalid token"
BAD_GET_APPLICATIONS=$(curl -s -X GET "$BASE_URL/applications?token=invalid")
echo "Bad get applications response: $BAD_GET_APPLICATIONS"

echo
echo "=========================================="
echo "API Testing Complete"
echo "=========================================="
