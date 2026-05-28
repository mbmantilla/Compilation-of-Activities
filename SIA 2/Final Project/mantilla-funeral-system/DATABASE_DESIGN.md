# Database Design

## users
| Field | Type | Description |
|---|---|---|
| id | BIGINT PK | Unique user ID |
| name | VARCHAR | Full name |
| email | VARCHAR UNIQUE | Login email |
| password | VARCHAR | Hashed password |
| role | ENUM(client, admin) | User role |
| phone | VARCHAR NULL | Contact number |
| address | VARCHAR NULL | Client address |
| timestamps | TIMESTAMP | Created/updated dates |

## funeral_services
| Field | Type | Description |
|---|---|---|
| id | BIGINT PK | Unique service ID |
| name | VARCHAR | Service/package name |
| description | TEXT | Service description |
| price | DECIMAL | Service price |
| inclusions | TEXT NULL | Package inclusions |
| availability_status | ENUM(available, unavailable) | Service availability |
| image | VARCHAR NULL | Optional image path or URL |
| created_by | FK users.id | Admin who created the service |
| timestamps | TIMESTAMP | Created/updated dates |

## reservations
| Field | Type | Description |
|---|---|---|
| id | BIGINT PK | Unique reservation ID |
| reservation_code | VARCHAR UNIQUE | Tracking code |
| user_id | FK users.id | Client who made the reservation |
| funeral_service_id | FK funeral_services.id | Reserved service |
| deceased_name | VARCHAR | Name of deceased |
| deceased_age | TINYINT NULL | Age of deceased |
| date_of_death | DATE NULL | Date of death |
| preferred_schedule | DATE | Requested schedule |
| contact_person | VARCHAR | Contact person |
| contact_number | VARCHAR | Contact number |
| notes | TEXT NULL | Client notes |
| status | ENUM(pending, approved, rejected, cancelled) | Reservation status |
| admin_remarks | TEXT NULL | Admin comments |
| approved_by | FK users.id NULL | Admin who approved/rejected |
| cancelled_at | TIMESTAMP NULL | Cancellation timestamp |
| timestamps | TIMESTAMP | Created/updated dates |
