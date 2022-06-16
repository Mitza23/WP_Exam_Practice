using System;
using System.Collections.Generic;
using System.Linq;
using System.Web;
using System.Web.Mvc;
using documents_NET.DataAbstractionLayer;

namespace documents_NET.Controllers
{
    public class KeywordsController : Controller
    {
        // GET: Keywords
        public ActionResult Index()
        {
            return View();
        }


        public bool Add()
        {
            string key = Request.Params["key"];
            string value = Request.Params["value"];

            DAL dal = new DAL();

            bool result = dal.Add(key, value);

            if (result)
            {
                Response.Redirect("~/Home/Index");
            }
            return result;
        }
    }
}