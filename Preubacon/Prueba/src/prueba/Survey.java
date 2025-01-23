/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Classes/Class.java to edit this template
 */
package prueba;
import java.sql.Timestamp;
/**
 *
 * @author marco
 */
public class Survey {
    private int id;
    private String cedula;
    private boolean pregunta1;
    private boolean pregunta2;
    private Timestamp fechaCreacion;
    
    public int getId() { return id; }
    public void setId(int id) { this.id = id; }
    
    public String getCedula() { return cedula; }
    public void setCedula(String cedula) { this.cedula = cedula; }
    
    public boolean isPregunta1() { return pregunta1; }
    public void setPregunta1(boolean pregunta1) { this.pregunta1 = pregunta1; }
    
    public boolean isPregunta2() { return pregunta2; }
    public void setPregunta2(boolean pregunta2) { this.pregunta2 = pregunta2; }
    
    public Timestamp getFechaCreacion() { return fechaCreacion; }
    public void setFechaCreacion(Timestamp fechaCreacion) { this.fechaCreacion = fechaCreacion; }
}
