Here are all the **API endpoints**:  

---

## **🔹 Student Endpoints (CRUD)**  

### **1️⃣ Create a New Student**
- **Method:** `POST`
- **Endpoint:** `/api/v1/students`
- **Description:** Creates a new student record.
- **Payload:**  
  ```json
  {
      "user_id": 1,
      "class_id": 2,
      "name": "John Doe",
      "section": "A",
      "roll_number": "STU123",
      "date_of_birth": "2010-05-15",
      "parent_id": 3,
      "address": "Kathmandu",
      "phone": "9812345678",
      "admission_date": "2024-03-01"
  }
  ```
---

### **2️⃣ Get All Students**
- **Method:** `GET`
- **Endpoint:** `/api/v1/students`
- **Description:** Fetches a list of all students.

---

### **3️⃣ Get a Single Student**
- **Method:** `GET`
- **Endpoint:** `/api/v1/students/{id}`
- **Description:** Fetches a specific student by ID.

---

### **4️⃣ Update a Student (Full Update)**
- **Method:** `PUT`
- **Endpoint:** `/api/v1/students/{id}`
- **Description:** Updates **all fields** of the student (fields cannot be omitted).
- **Payload:**  
  ```json
  {
      "user_id": 1,
      "class_id": 2,
      "name": "John Doe",
      "section": "A",
      "roll_number": "STU123",
      "date_of_birth": "2010-05-15",
      "parent_id": 3,
      "address": "Kathmandu",
      "phone": "9812345678",
      "admission_date": "2024-03-01"
  }
  ```

---

### **5️⃣ Update a Student (Partial Update)**
- **Method:** `PATCH`
- **Endpoint:** `/api/v1/students/{id}`
- **Description:** Updates only the **specified fields**.
- **Payload Example (Updating Name & Address only):**  
  ```json
  {
      "name": "Jane Doe",
      "address": "Pokhara"
  }
  ```

---

### **6️⃣ Delete a Student**
- **Method:** `DELETE`
- **Endpoint:** `/api/v1/students/{id}`
- **Description:** Deletes a student and removes the associated user account (if exists).

---

## **🔹 User Account Management for Students**
### **7️⃣ Create a User Account for a Student**
- **Method:** `POST`
- **Endpoint:** `/api/v1/students/{id}/create-user`
- **Description:** Creates a user account for a student.
- **Payload:**  
  ```json
  {
      "email": "johndoe@example.com",
      "password": "securepassword"
  }
  ```

---
---


## **🔹 Teacher Endpoints (CRUD)**  

### **1️⃣ Create a New Teacher**
- **Method:** `POST`
- **Endpoint:** `/api/v1/teachers`
- **Description:** Creates a new teacher record.
- **Payload:**  
  ```json
  {
      "name": "Jane Doe",
      "user_id": 1,
      "subject": "Mathematics",
      "phone": "9812345678",
      "address": "Kathmandu",
      "position": "Principal",
      "hire_date": "2024-02-20"
  }
  ```
- **Success Response (201):**  
  ```json
  {
      "message": "Teacher created successfully!",
      "data": {
          "id": 1,
          "name": "Jane Doe",
          "subject": "Mathematics",
          "phone": "9812345678",
          "address": "Kathmandu",
          "position": "Principal",
          "hire_date": "2024-02-20"
      }
  }
  ```

---

### **2️⃣ Get All Teachers (Paginated)**
- **Method:** `GET`
- **Endpoint:** `/api/v1/teachers`
- **Description:** Fetches a paginated list of all teachers.

- **Success Response (200):**  
  ```json
  {
      "data": [
          {
              "id": 1,
              "name": "Jane Doe",
              "subject": "Mathematics",
              "position": "Principal"
          },
          {
              "id": 2,
              "name": "John Smith",
              "subject": "Science",
              "position": "Assistant Teacher"
          }
      ],
      "pagination": {
          "current_page": 1,
          "total_pages": 5,
          "per_page": 10,
          "total_items": 50
      }
  }
  ```

---

### **3️⃣ Get a Specific Teacher**
- **Method:** `GET`
- **Endpoint:** `/api/v1/teachers/{id}`
- **Description:** Fetches details of a specific teacher by ID.

- **Success Response (200):**  
  ```json
  {
      "id": 1,
      "name": "Jane Doe",
      "subject": "Mathematics",
      "phone": "9812345678",
      "address": "Kathmandu",
      "position": "Principal",
      "hire_date": "2024-02-20"
  }
  ```

- **Error Response (404 - Not Found):**  
  ```json
  {
      "message": "Teacher not found."
  }
  ```

---

### **4️⃣ Update a Teacher**
- **Method:** `PUT`
- **Endpoint:** `/api/v1/teachers/{id}`
- **Description:** Updates an existing teacher’s details.

- **Payload:**  
  ```json
  {
      "name": "Jane Doe Updated",
      "subject": "Physics",
      "position": "Assistant Teacher"
  }
  ```

- **Success Response (200):**  
  ```json
  {
      "message": "Teacher updated successfully!",
      "data": {
          "id": 1,
          "name": "Jane Doe Updated",
          "subject": "Physics",
          "position": "Assistant Teacher"
      }
  }
  ```

- **Error Response (404 - Not Found):**  
  ```json
  {
      "message": "Teacher not found."
  }
  ```

---

### **5️⃣ Partially Update a Teacher**
- **Method:** `PATCH`
- **Endpoint:** `/api/v1/teachers/{id}`
- **Description:** Partially updates a teacher’s details.

- **Payload Example:**  
  ```json
  {
      "subject": "English"
  }
  ```

- **Success Response (200):**  
  ```json
  {
      "message": "Teacher updated successfully!",
      "data": {
          "id": 1,
          "name": "Jane Doe Updated",
          "subject": "English",
          "position": "Assistant Teacher"
      }
  }
  ```

---

### **6️⃣ Delete a Teacher**
- **Method:** `DELETE`
- **Endpoint:** `/api/v1/teachers/{id}`
- **Description:** Deletes a teacher record.

- **Success Response (200):**  
  ```json
  {
      "message": "Teacher deleted successfully."
  }
  ```

- **Error Response (404 - Not Found):**  
  ```json
  {
      "message": "Teacher not found."
  }
  ```

---

### **7️⃣ Create a User Account for a Teacher**
- **Method:** `POST`
- **Endpoint:** `/api/v1/teachers/{id}/create-user`
- **Description:** Creates a user account for a teacher.

- **Payload:**  
  ```json
  {
      "email": "teacher@example.com",
      "password": "securepassword"
  }
  ```

- **Success Response (201):**  
  ```json
  {
      "message": "Teacher account created successfully!",
      "user": {
          "id": 10,
          "name": "Jane Doe",
          "email": "teacher@example.com",
          "role": "teacher"
      }
  }
  ```

- **Error Response (400 - User Already Exists):**  
  ```json
  {
      "message": "User account already exists."
  }
  ```

---
---

## **🔹 Subject Endpoints (CRUD)**  

### **1️⃣ Get All Subjects**  
- **Method:** `GET`  
- **Endpoint:** `/api/v1/subjects`  
- **Description:** Fetches a paginated list of subjects.  

#### ✅ **Success Response (200)**
```json
{
    "data": [
        {
            "id": 1,
            "name": "Mathematics",
            "class_id": 2,
            "teacher_id": 5
        },
        {
            "id": 2,
            "name": "Science",
            "class_id": 3,
            "teacher_id": 6
        }
    ],
    "links": {
        "first": "http://example.com/api/v1/subjects?page=1",
        "last": "http://example.com/api/v1/subjects?page=5",
        "prev": null,
        "next": "http://example.com/api/v1/subjects?page=2"
    },
    "meta": {
        "current_page": 1,
        "from": 1,
        "last_page": 5,
        "path": "http://example.com/api/v1/subjects",
        "per_page": 10,
        "to": 10,
        "total": 50
    }
}
```

#### ❌ **If No Subjects Found (200)**
```json
{
    "message": "No subjects found."
}
```

---

### **2️⃣ Create a New Subject**  
- **Method:** `POST`  
- **Endpoint:** `/api/v1/subjects`  
- **Description:** Creates a new subject.  

#### **🔹 Request Payload**
```json
{
    "name": "Physics",
    "class_id": 2,
    "teacher_id": 5
}
```

#### ✅ **Success Response (201)**
```json
{
    "message": "Subject created successfully",
    "subject": {
        "id": 10,
        "name": "Physics",
        "class_id": 2,
        "teacher_id": 5
    }
}
```

#### ❌ **Validation Error (422)**
```json
{
    "message": "Validation failed",
    "errors": {
        "name": ["The name field is required."],
        "class_id": ["The selected class does not exist."]
    }
}
```

#### ❌ **Database Error (500)**
```json
{
    "message": "Database error occurred",
    "error": "SQLSTATE[23000]: Integrity constraint violation: 1452 Cannot add or update..."
}
```

---

### **3️⃣ Get a Specific Subject**  
- **Method:** `GET`  
- **Endpoint:** `/api/v1/subjects/{id}`  
- **Description:** Fetches details of a subject by ID.  

#### ✅ **Success Response (200)**
```json
{
    "id": 1,
    "name": "Mathematics",
    "class": {
        "id": 2,
        "name": "Class 10"
    },
    "teacher": {
        "id": 5,
        "name": "Mr. Sharma"
    }
}
```

#### ❌ **Subject Not Found (404)**
```json
{
    "message": "The subject with ID 100 was not found."
}
```

---

### **4️⃣ Update a Subject**  
- **Method:** `PUT` or `PATCH`  
- **Endpoint:** `/api/v1/subjects/{id}`  
- **Description:** Updates an existing subject record.  

#### **🔹 Request Payload**
```json
{
    "name": "Advanced Mathematics",
    "class_id": 2,
    "teacher_id": 7
}
```

#### ✅ **Success Response (200)**
```json
{
    "message": "Subject updated successfully!",
    "data": {
        "id": 1,
        "name": "Advanced Mathematics",
        "class_id": 2,
        "teacher_id": 7
    }
}
```

#### ❌ **Validation Error (422)**
```json
{
    "message": "Validation failed.",
    "errors": {
        "class_id": ["The selected class does not exist."]
    }
}
```

#### ❌ **Subject Not Found (404)**
```json
{
    "message": "The subject with ID 100 was not found."
}
```

---

### **5️⃣ Delete a Subject**  
- **Method:** `DELETE`  
- **Endpoint:** `/api/v1/subjects/{id}`  
- **Description:** Deletes a specific subject.  

#### ✅ **Success Response (200)**
```json
{
    "message": "Subject deleted successfully"
}
```

#### ❌ **Subject Not Found (404)**
```json
{
    "message": "The subject with ID 100 was not found."
}
```

#### ❌ **Unexpected Error (500)**
```json
{
    "message": "An unexpected error occurred",
    "error": "SQLSTATE[23000]: Cannot delete due to foreign key constraint..."
}
```

---

### **✅ Summary of API Endpoints**  

| Method  | Endpoint                | Description                         |
|---------|-------------------------|-------------------------------------|
| `GET`   | `/api/v1/subjects`      | Fetch all subjects (paginated)     |
| `POST`  | `/api/v1/subjects`      | Create a new subject               |
| `GET`   | `/api/v1/subjects/{id}` | Get a specific subject by ID       |
| `PUT`   | `/api/v1/subjects/{id}` | Update a subject                   |
| `DELETE`| `/api/v1/subjects/{id}` | Delete a subject                   |

---
---
---

