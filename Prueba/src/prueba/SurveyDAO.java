/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Classes/Class.java to edit this template
 */
package prueba;
import java.sql.*;
import java.util.HashMap;
import java.util.Map;

/**
 *
 * @author marco
 */
public class SurveyDAO {
    public boolean saveSurvey(Survey survey) {
        String sql = "INSERT INTO surveys (cedula, pregunta1, pregunta2) VALUES (?, ?, ?)";
        try (Connection conn = DatabaseConnection.getConnection();
             PreparedStatement pstmt = conn.prepareStatement(sql)) {
            
            pstmt.setString(1, survey.getCedula());
            pstmt.setBoolean(2, survey.isPregunta1());
            pstmt.setBoolean(3, survey.isPregunta2());
            
            return pstmt.executeUpdate() > 0;
        } catch (SQLException e) {
            e.printStackTrace();
            return false;
        }
    }
    
    public boolean hasUserCompletedSurvey(String cedula) {
        String sql = "SELECT COUNT(*) FROM surveys WHERE cedula = ?";
        try (Connection conn = DatabaseConnection.getConnection();
             PreparedStatement pstmt = conn.prepareStatement(sql)) {
            
            pstmt.setString(1, cedula);
            ResultSet rs = pstmt.executeQuery();
            if (rs.next()) {
                return rs.getInt(1) > 0;
            }
        } catch (SQLException e) {
            e.printStackTrace();
        }
        return false;
    }
    
    public Survey getUserSurvey(String cedula) {
        String sql = "SELECT * FROM surveys WHERE cedula = ?";
        try (Connection conn = DatabaseConnection.getConnection();
             PreparedStatement pstmt = conn.prepareStatement(sql)) {
            
            pstmt.setString(1, cedula);
            ResultSet rs = pstmt.executeQuery();
            if (rs.next()) {
                Survey survey = new Survey();
                survey.setId(rs.getInt("id"));
                survey.setCedula(rs.getString("cedula"));
                survey.setPregunta1(rs.getBoolean("pregunta1"));
                survey.setPregunta2(rs.getBoolean("pregunta2"));
                survey.setFechaCreacion(rs.getTimestamp("fecha_creacion"));
                return survey;
            }
        } catch (SQLException e) {
            e.printStackTrace();
        }
        return null;
    }
    
    public Map<String, Integer> getReportePregunta1() {
        Map<String, Integer> resultado = new HashMap<>();
        String sql = "SELECT pregunta1, COUNT(*) as total FROM surveys GROUP BY pregunta1";
        try (Connection conn = DatabaseConnection.getConnection();
             Statement stmt = conn.createStatement();
             ResultSet rs = stmt.executeQuery(sql)) {
            
            resultado.put("Si", 0);
            resultado.put("No", 0);
            
            while (rs.next()) {
                boolean respuesta = rs.getBoolean("pregunta1");
                int total = rs.getInt("total");
                resultado.put(respuesta ? "Si" : "No", total);
            }
        } catch (SQLException e) {
            e.printStackTrace();
        }
        return resultado;
    }
    
    public Map<String, Integer> getReportePregunta2() {
        Map<String, Integer> resultado = new HashMap<>();
        String sql = "SELECT pregunta2, COUNT(*) as total FROM surveys GROUP BY pregunta2";
        try (Connection conn = DatabaseConnection.getConnection();
             Statement stmt = conn.createStatement();
             ResultSet rs = stmt.executeQuery(sql)) {
            
            resultado.put("Si", 0);
            resultado.put("No", 0);
            
            while (rs.next()) {
                boolean respuesta = rs.getBoolean("pregunta2");
                int total = rs.getInt("total");
                resultado.put(respuesta ? "Si" : "No", total);
            }
        } catch (SQLException e) {
            e.printStackTrace();
        }
        return resultado;
    }
}
