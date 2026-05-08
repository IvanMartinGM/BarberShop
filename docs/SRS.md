# Software Requirements Specification (SRS)
# Barber Shop Management System

---

# 1. Introduction

## 1.1 Purpose

This document defines the functional and non-functional requirements of the Barber Shop Management System.

The purpose of the system is to provide a web-based platform for managing barber shop operations such as appointment scheduling, customer management, services, payments, employee administration, and role-based access control.

This document also describes the architecture, scope, and objectives of the project.

---

## 1.2 Intended Audience

This document is intended for:

- Developers
- System designers
- Testers
- Future contributors

who will participate in the development or maintenance of the project.

---

## 1.3 Intended Use

The purpose of this document is to describe the system requirements, features, architecture, and constraints in a clear and organized way.

---

## 1.4 Product Scope

The Barber Shop Management System will provide:

- User authentication and authorization
- Role-based access control
- Barber management
- Customer management
- Appointment scheduling
- Service management
- Payment management
- Schedule administration

The system aims to improve appointment organization and simplify daily barber shop operations.

---

## 1.5 Definitions and Acronyms

This section defines technical terms, abbreviations, and acronyms used throughout the document to avoid ambiguity.

---

# 2. Overall Description

## 2.1 User Needs

The system is intended to help barber shop staff manage appointments, services, schedules, and customer information efficiently.

Customers will be able to:

- Schedule appointments
- View appointment history
- View available services

Administrators will manage:

- Employees
- Services
- Roles
- Payments

---

## 2.2 Assumptions and Dependencies

- The system requires an internet connection.
- Users must have modern web browsers.
- The application depends on a relational database system.
- JavaScript must be enabled for frontend validation features.

---

# 3. System Features and Requirements

# 3.1 Functional Requirements

---

## 3.1.1 Authentication

- FR-1 The system shall provide a login interface with email and password.
- FR-2 The system shall validate user credentials before granting access.
- FR-3 The system shall restrict access to authenticated users only.
- FR-4 The system shall implement role-based access control.
- FR-5 The system shall allow administrators to create employee accounts.
- FR-6 The system shall allow administrators to assign roles to users.
- FR-7 The system shall provide logout functionality.
- FR-8 The system shall allow password recovery functionality.

---

## 3.1.2 User & Role Management

- FR-9 The system shall allow administrators to create users.
- FR-10 The system shall allow administrators to update user information.
- FR-11 The system shall allow administrators to deactivate users.
- FR-12 The system shall allow administrators to assign roles to users.
- FR-13 The system shall restrict functionalities based on user roles.

---

## 3.1.3 Barber Management

- FR-14 The system shall allow administrators to register barbers.
- FR-15 The system shall allow administrators to update barber information.
- FR-16 The system shall display available barbers.
- FR-17 The system shall manage barber schedules.

---

## 3.1.4 Service Management

- FR-18 The system shall allow administrators to create services.
- FR-19 The system shall allow administrators to update services.
- FR-20 The system shall allow administrators to delete services.
- FR-21 The system shall display available services.
- FR-22 The system shall store service prices and duration.

---

## 3.1.5 Appointment Management

- FR-23 The system shall allow customers to schedule appointments.
- FR-24 The system shall allow customers to cancel appointments.
- FR-25 The system shall prevent overlapping appointments.
- FR-26 The system shall allow employees to view appointment schedules.
- FR-27 The system shall store appointment history.
- FR-28 The system shall associate appointments with customers and barbers.

---

## 3.1.6 Payment Management

- FR-29 The system shall register payments for completed services.
- FR-30 The system shall store payment records.
- FR-31 The system shall calculate total service cost.
- FR-32 The system shall generate payment reports.

---

# 3.2 Non-Functional Requirements

## 3.2.1 Performance Requirements

- NFR-1 The system shall support at least 50 concurrent users.
- NFR-2 The system shall respond within 2 seconds under normal conditions.

---

## 3.2.2 Security Requirements

- NFR-3 Passwords shall be stored using secure hashing algorithms.
- NFR-4 The system shall validate all user input on the server side.
- NFR-5 The system shall implement role-based authorization.
- NFR-6 The system shall use HTTPS in production environments.

---

## 3.2.3 Reliability Requirements

- NFR-7 The system shall maintain data consistency.
- NFR-8 Database transactions shall be rolled back in case of failure.

---

## 3.2.4 Maintainability Requirements

- NFR-9 The system shall follow the MVC architectural pattern.
- NFR-10 The system shall use object-oriented programming principles.
- NFR-11 The source code shall be organized and documented.

---

## 3.2.5 Usability Requirements

- NFR-12 The system shall provide an intuitive and responsive interface.
- NFR-13 Users shall complete common tasks in no more than three steps.

---

# 3.3 Interface Requirements

- NFR-14 The system shall provide a web-based interface accessible through modern browsers.
- NFR-15 The system shall support responsive design for desktop and tablet devices.

---

# 4. Design Constraints

- The backend shall be developed using Vanilla PHP with OOP.
- The project shall follow the MVC architecture.
- Frontend technologies:
  - HTML5
  - CSS3
  - JavaScript
- Database:
  - MariaDB

---

# 5. Database Requirements

## Main Entities

- User
- Role
- Customer
- Barber
- Service
- Appointment
- Schedule
- Payment

---

# 6. Preliminary Schedule and Budget

This section defines the estimated development phases, timeline, and project resources.

---

# 7. Appendices

## 7.1 Glossary

Definitions of technical concepts and abbreviations used in the project.

---

## 7.2 Use Cases and Diagrams

- Use Case Diagram
- Entity Relationship Diagram (ERD)
- Class Diagram
- Sequence Diagram
- Activity Diagram