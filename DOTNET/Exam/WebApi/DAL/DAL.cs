using Data.Entities;

namespace WebApi.DAL;

public class DAL
{
    public List<Student> GetStudentsFromGroup(int group_id)
    {
        MySql.Data.MySqlClient.MySqlConnection conn;
        string myConnectionString;

        myConnectionString = "server=localhost;uid=root;pwd=;database=wp;";
        List<Student> slist = new List<Student>();

        try
        {
            conn = new MySql.Data.MySqlClient.MySqlConnection();
            conn.ConnectionString = myConnectionString;
            conn.Open();

            MySqlCommand cmd = new MySqlCommand();
            cmd.Connection = conn;
            cmd.CommandText = "select * from students where group_id=" + group_id;
            MySqlDataReader myreader = cmd.ExecuteReader();

            while (myreader.Read())
            {
                Student stud = new Student();
                stud.Id = myreader.GetInt32("id");
                stud.Nume = myreader.GetString("name");
                stud.Password = myreader.GetString("password");
                stud.Group_id = myreader.GetInt32("group_id");
                slist.Add(stud);
            }
            myreader.Close();
        }
        catch (MySql.Data.MySqlClient.MySqlException ex)
        {
            Console.Write(ex.Message);
        }
        return slist;
    }

    public List<Post> GetAllPosts()
    {
        MySql.Data.MySqlClient.MySqlConnection conn;
        string myConnectionString;

        myConnectionString = "server=localhost;uid=root;pwd=;database=wp;";
        List<Post> slist = new List<Post>();

        try
        {
            conn = new MySql.Data.MySqlClient.MySqlConnection();
            conn.ConnectionString = myConnectionString;
            conn.Open();

            MySqlCommand cmd = new MySqlCommand();
            cmd.Connection = conn;
            cmd.CommandText = "select * from posts" ;
            MySqlDataReader myreader = cmd.ExecuteReader();

            while (myreader.Read())
            {
                Post stud = new Post();
                stud.Id = myreader.GetInt32("id");
                stud.User = myreader.GetString("user");
                stud.TopicId = myreader.GetString("topic_id");
                stud.Text = myreader.GetInt32("text");
                stud.Date = myreader.GetInt32("date");
                slist.Add(stud);
            }
            myreader.Close();
        }
        catch (MySql.Data.MySqlClient.MySqlException ex)
        {
            Console.Write(ex.Message);
        }
        return slist;
    }

    public void addPost(int id, string user, int topicId, string text, int date)
    {
        MySql.Data.MySqlClient.MySqlConnection conn;
        string myConnectionString;

        myConnectionString = "server=localhost;uid=root;pwd=;database=wp;";

        try
        {
            conn = new MySql.Data.MySqlClient.MySqlConnection();
            conn.ConnectionString = myConnectionString;
            conn.Open();

            MySqlCommand cmd = new MySqlCommand();
            cmd.Connection = conn;
            cmd.CommandText = "insert into posts values(" + id + ", '"
                              + user + "', "
                              + topicId + ", '"
                              + text + "', "
                              + date + ")";
           cmd.ExecuteReader();
        }
        catch (MySql.Data.MySqlClient.MySqlException ex)
        {
            Console.Write(ex.Message);
        }
    }
}