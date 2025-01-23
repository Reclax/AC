/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Classes/Class.java to edit this template
 */
package prueba;
import java.sql.*;
/**
 *
 * @author marco
 */
public class UserDAO {
    public boolean registerUser(User user) {
        String sql = "INSERT INTO users (cedula, nombre, apellido, clave, is_admin) VALUES (?, ?, ?, ?, ?)";
        try (Connection conn = DatabaseConnection.getConnection();
             PreparedStatement pstmt = conn.prepareStatement(sql)) {
            
            pstmt.setString(1, user.getCedula());
            pstmt.setString(2, user.getNombre());
            pstmt.setString(3, user.getApellido());
            pstmt.setString(4, user.getClave());
            pstmt.setBoolean(5, user.isEsAdmin());
            
            return pstmt.executeUpdate() > 0;
        } catch (SQLException e) {
            e.printStackTrace();
            return false;
        }
    }
    
    public User login(String cedula, String clave) {
        String sql = "SELECT * FROM users WHERE cedula = ? AND clave = ?";
        try (Connection conn = DatabaseConnection.getConnection();
             PreparedStatement pstmt = conn.prepareStatement(sql)) {
            
            pstmt.setString(1, cedula);
            pstmt.setString(2, clave);
            
            ResultSet rs = pstmt.executeQuery();
            if (rs.next()) {
                User user = new User(
                    rs.getString("cedula"),
                    rs.getString("nombre"),
                    rs.getString("apellido"),
                    rs.getString("clave"),
                    rs.getBoolean("is_admin")
                );
                return user;
            }
        } catch (SQLException e) {
            e.printStackTrace();
        }
        return null;
    }
}
