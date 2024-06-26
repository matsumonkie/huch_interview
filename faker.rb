# prerequisites:
#  - gem install faker
#  - gem install csv
#
# To use:
#
# ruby ./faker.rb
#

require 'faker'
require 'csv'

# 100000 users is fast to generate but is super slow to import in the db
# due to the hashing password function being quite slow.
# so for the sake of this exercise, we only generate 100 users
rows = (1..100).map do
  [
    Faker::Internet.username(specifier: 5..10),
    Faker::Name.first_name,
    Faker::Name.last_name,
    Faker::Date.birthday(min_age: 18, max_age: 65),
    Faker::Internet.unique.email,
    Faker::Internet.password(min_length: 8),
  ]
end

CSV.open('users.csv', 'w') do |csv|
  rows.each do |row|
    csv << row
  end
end
