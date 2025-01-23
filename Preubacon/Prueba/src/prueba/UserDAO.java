/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Classes/Class.java to edit this template
 */
package prueba;
import java.sql.*;
import java.security.MessageDigest;
import java.security.NoSuchAlgorithmException;
import java.security.SecureRandom;
import java.util.Base64;

/**
 *
 * @author marco
 */
public class UserDAO {
    // Method to generate a salt
    private String generateSalt() {
        SecureRandom random = new SecureRandom();
        byte[] salt = new byte[16];
        random.nextBytes(salt);
        return Base64.getEncoder().encodeToString(salt);
    }

    // Method to hash the password
    private String hashPassword(String password, String salt) {
        try {
            MessageDigest md = MessageDigest.getInstance("SHA-256");
            md.update(salt.getBytes());
            byte[] hashedPassword = md.digest(password.getBytes());
            return Base64.getEncoder().encodeToString(hashedPassword);
        } catch (NoSuchAlgorithmException e) {
            throw new RuntimeException("Error hashing password", e);
        }
    }

    public boolean registerUser(User user) {
        String sql = "INSERT INTO users (cedula, nombre, apellido, clave, salt, is_admin) VALUES (?, ?, ?, ?, ?, ?)";
        try (Connection conn = DatabaseConnection.getConnection();
             PreparedStatement pstmt = conn.prepareStatement(sql)) {
            
            // Generate a unique salt for this user
            String salt = generateSalt();
            
            // Hash the password with the salt
            String hashedPassword = hashPassword(user.getClave(), salt);
            
            pstmt.setString(1, user.getCedula());
            pstmt.setString(2, user.getNombre());
            pstmt.setString(3, user.getApellido());
            pstmt.setString(4, hashedPassword);
            pstmt.setString(5, salt);
            pstmt.setBoolean(6, user.isEsAdmin());
            
            return pstmt.executeUpdate() > 0;
        } catch (SQLException e) {
            e.printStackTrace();
            return false;
        }
    }
    
    public User login(String cedula, String clave) {
        String sql = "SELECT * FROM users WHERE cedula = ?";
        try (Connection conn = DatabaseConnection.getConnection();
             PreparedStatement pstmt = conn.prepareStatement(sql)) {
            
            pstmt.setString(1, cedula);
            
            ResultSet rs = pstmt.executeQuery();
            if (rs.next()) {
                String storedSalt = rs.getString("salt");
                String storedPassword = rs.getString("clave");
                
                // Hash the provided password with the stored salt
                String hashedInputPassword = hashPassword(clave, storedSalt);
                
                // Compare the hashed passwords
                if (hashedInputPassword.equals(storedPassword)) {
                    return new User(
                        rs.getString("cedula"),
                        rs.getString("nombre"),
                        rs.getString("apellido"),
                        storedPassword,  // Store hashed password
                        rs.getBoolean("is_admin")
                    );
                }
            }
        } catch (SQLException e) {
            e.printStackTrace();
        }
        return null;
    }
}